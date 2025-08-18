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
	 $rid = $_GET['a'];	 
	}

$sql_tblsub=mysqli_query($link,"select * from tbl_discard_sub where plantcode='".$plantcode."' and  did='".$rid."'") or die(mysqli_error($link));
//echo $t=mysqli_num_rows($sql_tblsub);
$row_tblsub=mysqli_fetch_array($sql_tblsub);

 $trid=$row_tblsub['did_s'];
$itmdchk="";
$sql_eindent_sub=mysqli_query($link,"select * from tbl_discard_sub where plantcode='".$plantcode."' and  did_s='".$trid."'") or die(mysqli_error($link));
while($row_eindent_sub=mysqli_fetch_array($sql_eindent_sub))
{

if($itmdchk!="")
	{
	$itmdchk=$itmdchk.$row_eindent_sub['items_id'].",";
	}
	else
	{
	$itmdchk=$row_eindent_sub['items_id'].",";
	}
}

$class_sql=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_tblsub['crop']."'") or die(mysqli_error($link));
$row_class = mysqli_fetch_array($class_sql);

$item_sql=mysqli_query($link,"select * from tblvariety where varietyid='".$row_tblsub['variety']."' and actstatus='Active'") or die(mysqli_error($link));
$row_item = mysqli_fetch_array($item_sql);
?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
	<tr class="tblsubtitle" height="20">
  <td colspan="4" align="center" class="tblheading">Post Item From</td>
</tr>
<tr height="15"><td colspan="4" align="right" class="tblheading"><font color="#FF0000" >* </font>indicates required field&nbsp;</td></tr>
<?php 
$classqry=mysqli_query($link,"select cropid, cropname from tblcrop where cropid='".$row_tblsub['crop']."' order by cropname") or die(mysqli_error($link));
$noticia_class = mysqli_fetch_array($classqry);
?>
<tr class="Dark" height="25">
   <td width="154"  align="right"  valign="middle" class="tblheading">&nbsp;Crop&nbsp;</td>
           <td align="left"  valign="middle" colspan="3" class="tbltext">&nbsp;<input type="hidden" class="tbltext" name="txtclass"  value="<?php echo $noticia_class['cropid'];?>" /><?php echo $noticia_class['cropname'];?></td></tr>
 <?php 
$tto=0;
$sql_veriety=mysqli_query($link,"select varietyid, popularname from tblvariety where varietyid='".$row_tblsub['variety']."' and actstatus='Active'") or die(mysqli_error($link));
$tto=mysqli_num_rows($sql_veriety);
if($tto>0)
{		
	$row_variety=mysqli_fetch_array($sql_veriety);
	$itemid=$row_variety['popularname'];				
}
else
{
	$itemid=$row_tblsub['variety'];
}
?>            
         <tr class="Light" height="30">
<td align="right" valign="middle" class="tblheading">Variety&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="3" id="vitem" >&nbsp;<input type="hidden" class="tbltext" name="txtitem" id="itm" value="<?php echo $row_tblsub['variety'];?>" /><?php echo $itemid;?></td>
</tr><input type="hidden" name="itmdchk" value="" />	
 <tr class="Dark" height="30" >
<td align="right" valign="middle" class="tblheading">Lot Number&nbsp;</td>
<td align="left" valign="middle" class="tbltext" colspan="2"  >&nbsp;<input name="txtlot1" type="hidden" size="15" class="tbltext" tabindex=""  maxlength="14"  value="<?php echo $row_tblsub['lotnumber']?>" onchange="ltchk(this.value);"  onBlur="javascript:this.value=this.value.toUpperCase();" readonly="true" style="background-color:#CCCCCC" ><?php echo $row_tblsub['lotnumber']?></td>
</tr>		 
</table><input name="txtrettype" value="good" type="hidden"><input name="txtrettyp" value="good" type="hidden"> 
<div id="subdiv" style="display:block">	
<div id="subdiv24">
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" >  <tr class="tblsubtitle" height="20">

 <td colspan="4" align="center" valign="middle" class="tblheading">Existing SLOC</td>
  <td  colspan="2" align="center" valign="middle" class="tblheading">Discard</td>
  <td colspan="2" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="60" align="center" valign="middle" class="tblheading" style="display:none">Select</td>
<td width="60" align="center" valign="middle" class="tblheading">Stage</td>
<td width="98" align="center" valign="middle" class="tblheading">SLOC</td>
<td width="84" align="center" valign="middle" class="tblheading">Bags</td>
<td width="103" align="center" valign="middle" class="tblheading">Qty</td>
<td width="84" align="center" valign="middle" class="tblheading">Bags</td>
<td width="103" align="center" valign="middle" class="tblheading">Qty</td>
<td width="65" align="center" valign="middle" class="tblheading">Bags</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
 <?php
$srno=1; $rtotalups=0; $rtotalqty=0;

$sql_tbl_sub=mysqli_query($link,"select * from tbl_discard_sloc where plantcode='".$plantcode."' and  discard_id=$rid") or die(mysqli_error($link));
$tot_tblissue=mysqli_num_rows($sql_tbl_sub);

while($row_tbl_sub=mysqli_fetch_array($sql_tbl_sub))
{

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_id='".$row_tbl_sub['discard_rowid']."'") or die(mysqli_error($link)); 
$row_issuetbl=mysqli_fetch_array($sql_issuetbl);

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
  
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
$rtotalups=$rtotalups+$row_issuetbl['lotldg_balbags'];
$rtotalqty=$rtotalqty+$row_issuetbl['lotldg_balqty'];
if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" id="<?php echo $srno;?>" name="slocissue" value="<?php echo $row_issuetbl['lotldg_id'];?>" onclick="checkchk('<?php echo $srno;?>')" checked="checked" readonly="true" disabled="disabled" style="background-color:#CCCCCC"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="stage_<?php echo $srno;?>" name="stage_<?php echo $srno;?>" value="<?php echo $row_tbl_sub['sstage'];?>" /><?php echo $row_tbl_sub['sstage'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['lotldg_balbags'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['lotldg_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_discard'];?>" onchange="upschk(this.value,'<?php echo $srno;?>')" onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_discard'];?>" onchange="qtychk(this.value,'<?php echo $srno?>')" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_balance'];?>" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_balance'];?>" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" id="<?php echo $srno;?>"  name="slocissue" value="<?php echo $row_issuetbl['lotldg_id'];?>" onclick="checkchk('<?php echo $srno;?>')"  checked="checked" readonly="true" disabled="disabled" style="background-color:#CCCCCC"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="stage_<?php echo $srno;?>" name="stage_<?php echo $srno;?>" value="<?php echo $row_tbl_sub['sstage'];?>" /><?php echo $row_tbl_sub['sstage'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['lotldg_balbags'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['lotldg_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_discard'];?>" onchange="upschk(this.value,'<?php echo $srno;?>')" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_discard'];?>" onchange="qtychk(this.value,'<?php echo $srno?>')" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['ups_balance'];?>" onkeypress="return isNumberKey(event)"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_tbl_sub['qty_balance'];?>" readonly="true" style="background-color:#CCCCCC" /></td>
 </tr>
 <?php
 }
 $srno++;
 }
$sql_mainissue=mysqli_query($link,"select distinct lotldg_sstage from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_crop='".$b."' and lotldg_variety='".$c."' and orlot='".$a."'") or die(mysqli_error($link));

while($row_mainissue=mysqli_fetch_array($sql_mainissue))
{ 

$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_crop='".$b."' and lotldg_variety='".$c."' and orlot='".$a."' and lotldg_sstage='".$row_mainissue['lotldg_sstage']."'") or die(mysqli_error($link));

while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_variety='".$row_tblsub['variety']."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_id='".$row_issue1[0]."'  and lotldg_balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
$sql_tbl_sub=mysqli_query($link,"select * from tbl_discard_sloc where plantcode='".$plantcode."' and  discard_rowid='".$row_issuetbl['lotldg_id']."' and discard_id='".$rid."'") or die(mysqli_error($link));
$tot_tblissue=mysqli_num_rows($sql_tbl_sub);

 if($tot_tblissue==0)
 {

  $wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
  
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

if($slocs!="")
$slocs=$slocs.$wareh.$binn.$subbinn."<br/>";
else
$slocs=$wareh.$binn.$subbinn."<br/>";
$rtotalups=$rtotalups+$row_issuetbl['lotldg_balbags'];
$rtotalqty=$rtotalqty+$row_issuetbl['lotldg_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" id="<?php echo $srno;?>" name="slocissue" value="<?php echo $row_issuetbl['lotldg_id'];?>" onclick="checkchk('<?php echo $srno;?>')" checked="checked" readonly="true" disabled="disabled" style="background-color:#CCCCCC"  /></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="stage_<?php echo $srno;?>" name="stage_<?php echo $srno;?>" value="<?php echo $row_issuetbl['lotldg_sstage'];?>" /><?php echo $row_issuetbl['lotldg_sstage'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['lotldg_balbags'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['lotldg_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="upschk(this.value,'<?php echo $srno;?>')"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="qtychk(this.value,'<?php echo $srno?>')"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['lotldg_balbags'];?>"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['lotldg_balqty'];?>" readonly="true" style="background-color:#CCCCCC"  /></td>
 </tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
<td align="center" valign="middle" class="tblheading" style="display:none"><input type="checkbox" id="<?php echo $srno;?>" name="slocissue" value="<?php echo $row_issuetbl['lotldg_id'];?>" onclick="checkchk('<?php echo $srno;?>')"  checked="checked" readonly="true" disabled="disabled" style="background-color:#CCCCCC" /></td>
<td align="center" valign="middle" class="tblheading"><input type="hidden" id="stage_<?php echo $srno;?>" name="stage_<?php echo $srno;?>" value="<?php echo $row_issuetbl['lotldg_sstage'];?>" /><?php echo $row_issuetbl['lotldg_sstage'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $slocs;?></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="upsavl_<?php echo $srno;?>" name="upsavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['lotldg_balbags'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="qtyavl_<?php echo $srno;?>" name="qtyavl_<?php echo $srno;?>" readonly="true" style="background-color:#CCCCCC" value="<?php echo $row_issuetbl['lotldg_balqty'];?>" size="5" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueups_<?php echo $srno;?>" name="issueups_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="upschk(this.value,'<?php echo $srno;?>')" onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="issueqty_<?php echo $srno;?>" name="issueqty_<?php echo $srno;?>" class="tbltext" size="5" value="0" onchange="qtychk(this.value,'<?php echo $srno?>')"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balups_<?php echo $srno?>" name="balups_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['lotldg_balbags'];?>"  onkeypress="return isNumberKey(event)" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" id="balqty_<?php echo $srno;?>" name="balqty_<?php echo $srno;?>" class="tbltext" size="5" value="<?php echo $row_issuetbl['lotldg_balqty'];?>" readonly="true" style="background-color:#CCCCCC"  /></td>
 </tr>
 <?php
 }
 $srno++;
 } 
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
 
</table>
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:pointer;"  onclick="pupdateform();" /></td>
</tr>
</table>
<input type="hidden" name="srno" value="<?php echo $srno;?>" /> <input type="hidden" name="chkbox" value=""/> <input type="hidden" name="srno1" value=""/><input type="hidden" name="edtrowid" value="<?php echo $rid;?>" /></div>
<input type="hidden" name="maintrid" value="<?php echo $trid;?>" /><input type="hidden" name="subtrid" value="<?php echo $rid;?>" />
</div>