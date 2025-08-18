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
	if(isset($_GET['f']))
	{
		$f = $_GET['f'];	 
	}
	if(isset($_GET['g']))
	{
		$trid = $_GET['g'];	 
	}

?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" > 
 <tr class="tblsubtitle" height="25">
   <td colspan="4" align="center" valign="middle" class="tblheading">Existing Sloc </td>
   <!--<td colspan="3" align="center" valign="middle" class="tblheading">Updated Sloc </td>
   <td width="59" rowspan="2" align="center" valign="middle" class="tblheading">Edit</td>-->
 </tr>
 <tr class="tblsubtitle" height="25">
<td width="45" align="center" valign="middle" class="tblheading">#</td>
<td width="119" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="103" align="center" valign="middle" class="tblheading">NoB</td>
<td width="110" align="center" valign="middle" class="tblheading">Qty</td>
<!--<td width="129" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="93" align="center" valign="middle" class="tblheading">NoB</td>
 <td width="74" align="center" valign="middle" class="tblheading">Qty</td>-->
 </tr>
<?php
$cnt=0;

$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_crop='".$c."' and lotldg_variety='".$f."' and lotldg_lotno='".$a."'") or die(mysqli_error($link));

$srno=1;
$totBags=0; $totqty=0;
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
$sloc="";
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_variety='".$f."' and lotldg_lotno='".$a."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
  $cnt++;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sloc=$wareh.$binn.$subbinn;
 // $row_issuetbl['lotldg_balbags'];
$totBags=$totBags+$row_issuetbl['lotldg_balbags'];
$totqty=$totqty+$row_issuetbl['lotldg_balqty'];

 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['lotldg_balbags'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['lotldg_balqty'];?><input type="hidden" name="rowid_<?php echo $srno;?>" value="<?php echo $row_issuetbl['lotldg_id']?>" /></td>
<!--<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
 <td align="center" valign="middle" class="tblheading">&nbsp;</td>
 <td align="center" valign="middle" class="tblheading"><img src="../images/addnew.jpg" border="0" style="cursor:pointer" onclick="showsloc('<?php echo $row_issuetbl['lotldg_balbags'];?>','<?php echo $row_issuetbl['lotldg_balqty'];?>','<?php echo $row_issue1[0]?>','<?php echo $row_whouse['perticulars'];?>');" /></td>-->
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $sloc;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['lotldg_balbags'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['lotldg_balqty'];?><input type="hidden" name="rowid_<?php echo $srno;?>" value="<?php echo $row_issuetbl['lotldg_id']?>" /></td>
<!--<td align="center" valign="middle" class="tblheading">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">&nbsp;</td>
 <td align="center" valign="middle" class="tblheading">&nbsp;</td>
 <td align="center" valign="middle" class="tblheading"><img src="../images/addnew.jpg" border="0" style="cursor:pointer" onclick="showsloc('<?php echo $row_issuetbl['lotldg_balbags'];?>','<?php echo $row_issuetbl['lotldg_balqty'];?>','<?php echo $row_issue1[0]?>','<?php echo $row_whouse['perticulars'];?>');" /></td>-->
 </tr>
 <?php
 }$srno++;
 } 
 } 
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="2">Total</td>
<td align="center" valign="middle" class="tblheading"><?php echo $totBags;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
<!-- <td colspan="4" align="center" valign="middle" class="tblheading">&nbsp;</td>-->
 </tr>

 <tr class="Dark" height="25">
<td align="right" valign="middle" class="tblheading" colspan="2">Shift Stock To:&nbsp;</td>
<td align="left" valign="middle" class="tblheading" colspan="2">&nbsp;<select class="tbltext" name="sloctyp" onchange="showsloc(this.value,'<?php echo $a;?>');">
<option value="" selected="selected" >Select</option>
<option value="Regular Warehouse" >Regular Warehouse</option>
<option value="Cold Storage" >Cold Storage</option>
<option value="Both"  >Both</option>
</select>&nbsp;<font color="#FF0000">*</font></td>
<!-- <td align="center" valign="middle" class="tblheading"><?php echo $totqty;?></td>
<td colspan="4" align="center" valign="middle" class="tblheading">&nbsp;</td>-->
 </tr>
 <?php
 if($cnt==0) 
 {
 ?>
  <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" colspan="4">Variety not in Stock</td>
 </tr>
 <?php
 }
// echo $trid;
 ?>
 <input type="hidden" name="txtBagsg" value="<?php echo $totBags;?>" /> <input type="hidden" name="txtqtyg" value="<?php echo $totqty;?>" />
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" /><input type="hidden" name="orwoid" value="" /><input type="hidden" name="trid" value="<?php echo $trid;?>" />
 <input type="hidden" name="otBags" value="<?php echo $totBags;?>" /><input type="hidden" name="otqty" value="<?php echo $totqty;?>" /> 
</table>
