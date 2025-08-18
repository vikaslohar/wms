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
	}require_once("../include/config.php");
	require_once("../include/connection.php");

if(isset($_GET['a']))
	{
	$rid = $_GET['a'];	 
	}

$sql_issuesub=mysqli_query($link,"select * from tblissue_sub where plantcode='".$plantcode."' and   issuesub_id='".$rid."'") or die(mysqli_error($link));
$row_issuesub=mysqli_fetch_array($sql_issuesub);


$class_sql=mysqli_query($link,"select classification_id, classification from tbl_classification where plantcode='".$plantcode."' and   classification_id='".$row_issuesub['classification_id']."'") or die(mysqli_error($link));
$row_class = mysqli_fetch_array($class_sql);

$item_sql=mysqli_query($link,"select items_id, stores_item, uom from tbl_stores where plantcode='".$plantcode."' and   items_id='".$row_issuesub['item_id']."'") or die(mysqli_error($link));
$row_item = mysqli_fetch_array($item_sql);


?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >

<tr class="Light" height="30">
      <td width="132" align="right" valign="middle" class="tblheading">Classification&nbsp;</td>
      <td width="341"  align="left" valign="middle" class="tbltext">&nbsp;<input name="txtclass" type="text" size="35" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_class['classification'];?>" /><input type="hidden" name="classid" value="<?php echo $row_class['classification_id']?>" /></td>
      <td width="92" align="right" valign="middle" class="tblheading">Items&nbsp;</td>
      <td width="275" align="left" valign="middle" class="tbltext">&nbsp;<input name="txtitem" type="text" size="35" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_item['stores_item'];?>" />&nbsp;<input type="hidden" name="itemid" value="<?php echo $row_item['items_id']?>" /> &nbsp; </td></tr>
    <tr class="Light" height="30">
      <td width="132" align="right" valign="middle" class="tblheading">&nbsp;UoM&nbsp;</td>
      <td width="341"  align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtuom" type="text" size="10" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuesub['uom']?>" /></td>
    
      <td align="right" valign="middle" class="tblheading">Quantity&nbsp;</td>
      <td  align="left" valign="middle" class="tbltext" >&nbsp;<input name="txtqty" type="text" size="5" class="tbltext" tabindex="" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuesub['qty_indent']?>" /></td>
    </tr>

</table>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" > 
<?php
/*$sql_issue=mysqli_query($link,"select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where plantcode='".$plantcode."' and   stlg_trclassid='".$row_tbl_sub['classification_id']."' and stlg_tritemid='".$row_tbl_sub['items_id']."'") or die(mysqli_error($link));
*/
$sql_tbl_sub=mysqli_query($link,"select * from tblissue_sloc where plantcode='".$plantcode."' and   issue_id='".$rid."'") or die(mysqli_error($link));
$tot_tblissue=mysqli_num_rows($sql_tbl_sub);


?>
 <tr class="tblsubtitle" height="20">

 <td colspan="4" align="center" valign="middle" class="tblheading">Existing SLOC</td>
  <td  colspan="2" align="center" valign="middle" class="tblheading">Issue</td>
  <td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="60" align="center" valign="middle" class="tblheading" style="display:none">Select</td>
<td width="98" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="84" align="center" valign="middle" class="tblheading">UPS</td>
<td width="103" align="center" valign="middle" class="tblheading">Qty</td>
<td width="84" align="center" valign="middle" class="tblheading">UPS</td>
<td width="103" align="center" valign="middle" class="tblheading">Qty</td>
<td width="65" align="center" valign="middle" class="tblheading">UPS</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
 <?php
$srno=1; $rtotalups=0; $rtotalqty=0;

while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{

$sql_issuetbl=mysqli_query($link,"select * from tbl_stldg_good where plantcode='".$plantcode."' and   stlg_id='".$row_tbl_sub['issue_rowid']."'") or die(mysqli_error($link)); 
$row_issuetbl=mysqli_fetch_array($sql_issuetbl);

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
  
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_issuetbl['stlg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_issuetbl['stlg_subbinid']."' and binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
$rtotalups=$rtotalups+$row_issuetbl['stlg_balups'];
$rtotalqty=$rtotalqty+$row_issuetbl['stlg_balqty'];

if($srno%2!=0)
{ 
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" id="<?php echo $srno;?>" checked="checked" name="slocissue" value="<?php echo $row_issuetbl['stlg_id'];?>" onclick="checkchk('<?php echo $srno;?>')"  disabled="disabled" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_issue'];?>" onchange="upschk(this.value,'<?php echo $srno;?>')" onblur="upschk(this.value,'<?php echo $srno;?>')" onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_issue'];?>" onchange="qtychk(this.value,'<?php echo $srno?>')" onblur="qtychk(this.value,'<?php echo $srno?>')" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_balance'];?>" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_balance'];?>" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 else
 { 
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" id="<?php echo $srno;?>" checked="checked" name="slocissue" value="<?php echo $row_issuetbl['stlg_id'];?>" onclick="checkchk('<?php echo $srno;?>')" disabled="disabled" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_issue'];?>" onchange="upschk(this.value,'<?php echo $srno;?>')" onblur="upschk(this.value,'<?php echo $srno;?>')" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_issue'];?>" onchange="qtychk(this.value,'<?php echo $srno?>')" onblur="qtychk(this.value,'<?php echo $srno?>')" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_balance'];?>" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_balance'];?>" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 $srno++;
 }

$sql_issue=mysqli_query($link,"select distinct stlg_whid, stlg_subbinid, stlg_binid from tbl_stldg_good where plantcode='".$plantcode."' and   stlg_trclassid='".$row_issuesub['classification_id']."' and stlg_tritemid='".$row_issuesub['item_id']."'") or die(mysqli_error($link));

while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysqli_query($link,"select max(stlg_id) from tbl_stldg_good where plantcode='".$plantcode."' and   stlg_subbinid='".$row_issue['stlg_subbinid']."' and stlg_binid='".$row_issue['stlg_binid']."' and stlg_whid='".$row_issue['stlg_whid']."' and stlg_tritemid='".$row_issuesub['item_id']."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_stldg_good where plantcode='".$plantcode."' and   stlg_id='".$row_issue1[0]."' and stlg_balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
$sql_tbl_sub=mysqli_query($link,"select * from tblissue_sloc where plantcode='".$plantcode."' and   issue_rowid='".$row_issuetbl['stlg_id']."' and issue_id='".$rid."'") or die(mysqli_error($link));
$tot_tblissue=mysqli_num_rows($sql_tbl_sub);

 if($tot_tblissue==0)
 {

  $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
  
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_issuetbl['stlg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_issuetbl['stlg_subbinid']."' and binid='".$row_issuetbl['stlg_binid']."' and whid='".$row_issuetbl['stlg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
$rtotalups=$rtotalups+$row_issuetbl['stlg_balups'];
$rtotalqty=$rtotalqty+$row_issuetbl['stlg_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" id="<?php echo $srno;?>" name="slocissue" value="<?php echo $row_issuetbl['stlg_id'];?>" onclick="checkchk('<?php echo $srno;?>')"checked="checked" disabled="disabled" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="upschk(this.value,'<?php echo $srno;?>')" onblur="upschk(this.value,'<?php echo $srno;?>')" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="qtychk(this.value,'<?php echo $srno?>')" onblur="qtychk(this.value,'<?php echo $srno?>')" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stlg_balups'];?>" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stlg_balqty'];?>" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" id="<?php echo $srno;?>" name="slocissue" value="<?php echo $row_issuetbl['stlg_id'];?>" onclick="checkchk('<?php echo $srno;?>')"checked="checked" disabled="disabled" readonly="true" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balups'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['stlg_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="upschk(this.value,'<?php echo $srno;?>')" onblur="upschk(this.value,'<?php echo $srno;?>')" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="qtychk(this.value,'<?php echo $srno?>')" onblur="qtychk(this.value,'<?php echo $srno?>')" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stlg_balups'];?>" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['stlg_balqty'];?>" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 $srno++;
 } 
 }
 } 
 ?>
  <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" style="display:none">&nbsp;</td>
<td align="center" valign="middle" class="tblheading">Total</td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalups;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $rtotalqty;?></td>
<td align="center" valign="middle" class="tblheading" colspan="4">&nbsp;</td>
 </tr>
 <input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" />
</table>

<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:Pointer;"  onclick="pupdateform();"   /></td>
</tr>
</table>