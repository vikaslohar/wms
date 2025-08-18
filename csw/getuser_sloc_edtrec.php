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
	$trid = $_GET['a'];	 
	}
if(isset($_GET['b']))
	{
	$subrid = $_GET['b'];	 
	}
if(isset($_GET['c']))
	{
	$stldgid = $_GET['c'];	 
	}	
if(isset($_GET['i']))
	{
	$txtlot1 = $_GET['i'];	 
	}
		
$sql_in1=mysqli_query($link,"select * from tbl_sloc_csw where plantcode='".$plantcode."' and  slid=$trid") or die(mysqli_error($link));
$row_in1=mysqli_fetch_array($sql_in1);

$crop=$row_in1['crop'];
$variety=$row_in1['variety'];
$c=$row_in1['crop'];
$b=$row_in1['variety'];

$sql_subtbl=mysqli_query($link,"select * from tbl_sloc_csw_sub where plantcode='".$plantcode."' and  slocid='".$trid."' and rowid='".$stldgid."'") or die(mysqli_error($link));
$tot_subtbl=mysqli_num_rows($sql_subtbl);

?>
<input type="hidden" name="orwoid" value="<?php echo $stldgid;?>" />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" > 
 <tr class="tblsubtitle" height="25">
  <td colspan="6" align="center" valign="middle" class="tblheading">Transfer from</td>
  </tr>
<tr class="tblsubtitle" height="25">
<td width="162" align="center" valign="middle" class="tblheading">WH</td>
<td width="152" align="center" valign="middle" class="tblheading">Bin</td>
<td width="182" align="center" valign="middle" class="tblheading">SubBin</td>
<td width="182" align="center" valign="middle" class="tblheading">NoB</td>
<td width="160" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$whi=0;$bni=0;$sbni=0;
/*$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_crop='".$c."' and lotldg_variety='".$b."'") or die(mysqli_error($link));

$srno=1; //$cnt=0;

 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 
$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_variety='".$b."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 
*/$otups=0; $otqty=0;
$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_id='".$stldgid."' and lotldg_balqty > 0") or die(mysqli_error($link)); 

 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
$whi=$row_issuetbl['lotldg_whid'];$bni=$row_issuetbl['lotldg_binid'];$sbni=$row_issuetbl['lotldg_subbinid'];   //$cnt++; 
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$otups=$totups+$row_issuetbl['lotldg_balups'];
$otqty=$totqty+$row_issuetbl['lotldg_balqty'];
 ?>
 <tr class="Light" height="25">
<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="osubid" value="<?php echo $row_issuetbl['lotldg_subbinid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['lotldg_balbags'];?></td>
<td align="center" valign="middle" class="tblheading"><?php echo $row_issuetbl['lotldg_balqty'];?></td>
</tr>
<?php
}
//}
?><input type="hidden" name="otBags" value="<?php echo $otups;?>" /><input type="hidden" name="otqty" value="<?php echo $otqty;?>" />
</table>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >
<tr class="tblsubtitle" height="20">
  <td colspan="10" align="center" valign="middle" class="tblheading">Transfer to </td>
  </tr>
<tr class="tblsubtitle" height="20">
  <td colspan="5" align="center" valign="middle" class="tblheading">Existing SLOC</td>
  <td rowspan="2" colspan="2" align="center" valign="middle" class="tblheading">Transfer</td>
  <td colspan="3" align="center" valign="middle" class="tblheading">Balance</td>
  </tr>
<tr class="tblsubtitle" height="20">
<td width="98" align="center" valign="middle" class="tblheading">WH</td>
<td width="86" align="center" valign="middle" class="tblheading">Bin</td>
<td width="100" align="center" valign="middle" class="tblheading">SubBin</td>
<td width="65" align="center" valign="middle" class="tblheading">NoB</td>
<td width="66" align="center" valign="middle" class="tblheading">Qty</td>
<td width="58" align="center" valign="middle" class="tblheading">NoB</td>
<td width="57" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$srno=1; 
/*$sql_class=mysqli_query($link,"select * from tbl_classification where plantcode='".$plantcode."' and  classification_id='".$c."'") or die(mysqli_error($link));
$row_class=mysqli_fetch_array($sql_class);
$classid=$row_class['classification'];

$sql_item=mysqli_query($link,"select * from tbl_stores where plantcode='".$plantcode."' and  items_id='".$b."'") or die(mysqli_error($link));
$row_item=mysqli_fetch_array($sql_item);
$itemid=$row_item['stores_item'];*/


$sql_issue=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_crop='".$c."' and lotldg_variety='".$b."' and lotldg_lotno='".$txtlot1."'") or die(mysqli_error($link));
$t=mysqli_num_rows($sql_issue);
$srno=1;
$totBags=0; $totqty=0; $cnt=0; $whid="";$binid="";$subbinid="";
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
 
 $sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_subbinid='".$row_issue['lotldg_subbinid']."' and lotldg_binid='".$row_issue['lotldg_binid']."' and lotldg_whid='".$row_issue['lotldg_whid']."' and lotldg_variety='".$b."' and lotldg_lotno='".$txtlot1."'") or die(mysqli_error($link));

$row_issue1=mysqli_fetch_array($sql_issue1); 
//echo $row_issue['stld_whid']."/".$row_issue['stld_binid']."/".$row_issue['stld_subbinid']."<br>";

if($trid > 0)
{
$sql_subtb=mysqli_query($link,"select * from tbl_sloc_csw_sub where plantcode='".$plantcode."' and  slocid='".$trid."' and subbinid='".$row_issue['lotldg_subbinid']."' and  binid='".$row_issue['lotldg_binid']."' and  whid='".$row_issue['lotldg_whid']."'") or die(mysqli_error($link));
$row_subtb=mysqli_num_rows($sql_subtb);
}
else
{
//$sql_subtb=mysqli_query($link,"select * from tbl_sloc_csw_sub where plantcode='".$plantcode."' and  gid='".$trid."' and rowid!='".$row_issue1[0]."'") or die(mysqli_error($link));
$row_subtb=0;
}
//echo $row_subtb;
//echo $row_subtb=mysqli_num_rows($sql_subtb);
//echo $t=mysqli_num_rows($sql_issue1);
//echo $row_issue1[0];
if($row_subtb == 0)
{

//echo $row_issue1[0]."<br>";echo $t=mysqli_num_rows($sql_issue1)."<br>";

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and  lotldg_id='".$row_issue1[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
//echo $t=mysqli_num_rows($sql_issuetbl);
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
// echo $row_issuetbl['stld_whid']."/".$row_issuetbl['stld_binid']."/".$row_issuetbl['stld_subbinid']."<br>";
 
 /*$sql_subtb=mysqli_query($link,"select * from tbl_sloc_csw_sub where plantcode='".$plantcode."' and  gid='".$trid."' and rowid='".$stldgid."'") or die(mysqli_error($link));
 $tot_subt=mysqli_num_rows($sql_subtb);
 $row_subt=mysqli_fetch_array($sql_subtb);
 if($tot_subt == 0)
{*/
 $cnt++;
 $whid=$row_issuetbl['lotldg_whid'];$binid=$row_issuetbl['lotldg_binid'];$subbinid=$row_issuetbl['lotldg_subbinid'];
 
 $wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$row_issuetbl['lotldg_whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$row_issuetbl['lotldg_subbinid']."' and binid='".$row_issuetbl['lotldg_binid']."' and whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$totBags=$totBags+$row_issuetbl['lotldg_balbags'];
$totqty=$totqty+$row_issuetbl['lotldg_balqty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
 
  <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg<?php echo $srno?>" style="width:70px;" onchange="wh<?php echo $srno?>(this.value,'edit');"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option <?php if($row_issuetbl['lotldg_whid']==$noticia_whg1['whid']) echo "selected";?> value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='".$plantcode."' and  whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing<?php echo $srno?>">&nbsp;<select class="tbltext" name="txtslbing<?php echo $srno?>" style="width:60px;" onchange="bin<?php echo $srno?>(this.value);" >
          <option value="" selected>--Bin--</option>
		  <?php while($noticia_bing1 = mysqli_fetch_array($bing1_query)) { ?>
          <option <?php if($row_issuetbl['lotldg_binid']==$noticia_bing1['binid']) echo "selected";?> value="<?php echo $noticia_bing1['binid'];?>" />  
          <?php echo $noticia_bing1['binname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='".$plantcode."' and  whid='".$row_issuetbl['lotldg_whid']."' and binid='".$row_issuetbl['lotldg_binid']."'") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing<?php echo $srno?>">&nbsp;<select class="tbltext" name="txtslsubbg<?php echo $srno?>" style="width:80px;" onchange="subbin<?php echo $srno?>(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
		  <?php while($noticia_subbing1 = mysqli_fetch_array($subbing1_query)) { ?>
          <option <?php if($row_issuetbl['lotldg_subbinid']==$noticia_subbing1['sid']) echo "selected";?> value="<?php echo $noticia_subbing1['sid'];?>" />  
          <?php echo $noticia_subbing1['sname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
	
<!--<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_issuetbl['lotldg_whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_issuetbl['lotldg_binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_issuetbl['lotldg_subbinid'];?>" /></td>-->
<td colspan="2"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['lotldg_balbags'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['lotldg_balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="Bags<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf<?php echo $srno;?>(this.value);" value="<?php echo $row_issuetbl['lotldg_balbags'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno;?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno;?>(this.value);" value="<?php echo $row_issuetbl['lotldg_balqty'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['lotldg_balbags'];?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['lotldg_balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid<?php echo $srno?>" value="<?php echo $row_issuetbl['lotldg_id'];?>" />
</tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">


  <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg<?php echo $srno?>" style="width:70px;" onchange="wh<?php echo $srno?>(this.value,'edit');"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option <?php if($row_issuetbl['lotldg_whid']==$noticia_whg1['whid']) echo "selected";?> value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='".$plantcode."' and  whid='".$row_issuetbl['lotldg_whid']."'") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing<?php echo $srno?>">&nbsp;<select class="tbltext" name="txtslbing<?php echo $srno?>" style="width:60px;" onchange="bin<?php echo $srno?>(this.value);" >
          <option value="" selected>--Bin--</option>
		  <?php while($noticia_bing1 = mysqli_fetch_array($bing1_query)) { ?>
          <option <?php if($row_issuetbl['lotldg_binid']==$noticia_bing1['binid']) echo "selected";?> value="<?php echo $noticia_bing1['binid'];?>" />  
          <?php echo $noticia_bing1['binname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='".$plantcode."' and  whid='".$row_issuetbl['lotldg_whid']."' and binid='".$row_issuetbl['lotldg_binid']."'") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing<?php echo $srno?>">&nbsp;<select class="tbltext" name="txtslsubbg<?php echo $srno?>" style="width:80px;" onchange="subbin<?php echo $srno?>(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
		  <?php while($noticia_subbing1 = mysqli_fetch_array($subbing1_query)) { ?>
          <option <?php if($row_issuetbl['lotldg_subbinid']==$noticia_subbing1['sid']) echo "selected";?> value="<?php echo $noticia_subbing1['sid'];?>" />  
          <?php echo $noticia_subbing1['sname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
	
<!--<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_issuetbl['lotldg_whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_issuetbl['lotldg_binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_issuetbl['lotldg_subbinid'];?>" /></td>-->
<td colspan="2"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['lotldg_balbags'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['lotldg_balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="Bags<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf<?php echo $srno;?>(this.value);" value="<?php echo $row_issuetbl['lotldg_balbags'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno;?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno;?>(this.value);" value="<?php echo $row_issuetbl['lotldg_balqty'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['lotldg_balbags'];?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $row_issuetbl['lotldg_balqty'];?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid<?php echo $srno?>" value="<?php echo $row_issuetbl['lotldg_id'];?>" />
</tr>
 <?php 
 }$srno++;
 } 
 } 
 }
?>
<?php //echo $cnt;
if($trid > 0 && $cnt <= 2)
 { 

 $p1_array=explode(",",$subrid);	
$numrec=count($p1_array);
 $ct=0;$up=0;$qt=0; $Bags=0; $qty=0; $Bags1=0; $qty1=0;
 $sql_gddist=mysqli_query($link,"select distinct whid, binid, subbinid from tbl_sloc_csw_sub where plantcode='".$plantcode."' and  slocid='".$trid."'") or die(mysqli_error($link));
while($t_gddist=mysqli_fetch_array($sql_gddist))
 {
 $sql_gdsum=mysqli_query($link,"select sum(bags), sum(qty) from tbl_sloc_csw_sub where plantcode='".$plantcode."' and  slocid='".$trid."' and whid='".$t_gddist['whid']."' and binid='".$t_gddist['binid']."' and subbinid='".$t_gddist['subbinid']."'") or die(mysqli_error($link));
$t_gdsum=mysqli_fetch_array($sql_gdsum);
/*$up=$t_gdsum[0];
$qt=$t_gdsum[1];*/
//echo $p1_array[$ct];
/*$sql_iss=mysqli_query($link,"select max(slocsubid) from tbl_sloc_csw_sub where plantcode='".$plantcode."' and  gid='".$trid."' and whid='".$t_gddist['whid']."' and binid='".$t_gddist['binid']."' and subbinid='".$t_gddist['subbinid']."'") or die(mysqli_error($link));
 $t=mysqli_fetch_array($sql_iss);*/
//$srno=1;
//echo $t[0];
$sql_issue=mysqli_query($link,"select * from tbl_sloc_csw_sub where plantcode='".$plantcode."' and  slocsubid='".$p1_array[$ct]."'") or die(mysqli_error($link));
$totBags=0; $totqty=0; 
 while($row_issue=mysqli_fetch_array($sql_issue))
 { 
  $up=$row_issue['opbags'];
  $qt=$row_issue['opqty'];
  $Bags=$row_issue['bags'];
  $qty=$row_issue['qty'];

$cnt++;
 $wareh=""; $binn=""; $subbinn=""; $sBags="";$sqty=0; $slocs=""; $gd=""; $slBags=0; $slqty=0;
 
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and  whid='".$row_issue['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and  binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and  sid='".$row_issue['subbinid']."' and binid='".$row_issue['binid']."' and whid='".$row_issue['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$totBags=$totBags+$row_issue['bags'];
$totqty=$totqty+$row_issue['qty'];
 if($srno%2!=0)
{
 ?>
 <tr class="Light" height="25">
  <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg<?php echo $srno?>" style="width:70px;" onchange="wh<?php echo $srno?>(this.value,'edit');"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option <?php if($row_issue['whid']==$noticia_whg1['whid']) echo "selected";?> value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='".$plantcode."' and  whid='".$row_issue['whid']."'") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing<?php echo $srno?>">&nbsp;<select class="tbltext" name="txtslbing<?php echo $srno?>" style="width:60px;" onchange="bin<?php echo $srno?>(this.value);" >
          <option value="" selected>--Bin--</option>
		  <?php while($noticia_bing1 = mysqli_fetch_array($bing1_query)) { ?>
          <option <?php if($row_issue['binid']==$noticia_bing1['binid']) echo "selected";?> value="<?php echo $noticia_bing1['binid'];?>" />  
          <?php echo $noticia_bing1['binname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='".$plantcode."' and  whid='".$row_issue['whid']."' and binid='".$row_issue['binid']."'") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing<?php echo $srno?>">&nbsp;<select class="tbltext" name="txtslsubbg<?php echo $srno?>" style="width:80px;" onchange="subbin<?php echo $srno?>(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
		  <?php while($noticia_subbing1 = mysqli_fetch_array($subbing1_query)) { ?>
          <option <?php if($row_issue['subbinid']==$noticia_subbing1['sid']) echo "selected";?> value="<?php echo $noticia_subbing1['sid'];?>" />  
          <?php echo $noticia_subbing1['sname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
	
<!--<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_issue['whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_issue['binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_issue['subbinid'];?>" /></td>-->
<td colspan="2"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg<?php echo $srno?>" class="tbltext" value="<?php echo $up;?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $qt;?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="Bags<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf<?php echo $srno;?>(this.value);" value="<?php echo $Bags;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno;?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno;?>(this.value);" value="<?php echo $qty;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg<?php echo $srno?>" class="tbltext" value="<?php echo $Bags;?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $qty;?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid<?php echo $srno?>" value="<?php echo $row_issue['rowid'];?>" />
</tr>
 <?php
 }
 else
 {
 ?>
 <tr class="Dark" height="25">
  <?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;<select class="tbltext" name="txtslwhg<?php echo $srno?>" style="width:70px;" onchange="wh<?php echo $srno?>(this.value,'edit');"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option <?php if($row_issue['whid']==$noticia_whg1['whid']) echo "selected";?> value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode='".$plantcode."' and  whid='".$row_issue['whid']."'") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing<?php echo $srno?>">&nbsp;<select class="tbltext" name="txtslbing<?php echo $srno?>" style="width:60px;" onchange="bin<?php echo $srno?>(this.value);" >
          <option value="" selected>--Bin--</option>
		  <?php while($noticia_bing1 = mysqli_fetch_array($bing1_query)) { ?>
          <option <?php if($row_issue['binid']==$noticia_bing1['binid']) echo "selected";?> value="<?php echo $noticia_bing1['binid'];?>" />  
          <?php echo $noticia_bing1['binname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='".$plantcode."' and  whid='".$row_issue['whid']."' and binid='".$row_issue['binid']."'") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing<?php echo $srno?>">&nbsp;<select class="tbltext" name="txtslsubbg<?php echo $srno?>" style="width:80px;" onchange="subbin<?php echo $srno?>(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
		  <?php while($noticia_subbing1 = mysqli_fetch_array($subbing1_query)) { ?>
          <option <?php if($row_issue['subbinid']==$noticia_subbing1['sid']) echo "selected";?> value="<?php echo $noticia_subbing1['sid'];?>" />  
          <?php echo $noticia_subbing1['sname'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
		
<!--<td align="center" valign="middle" class="tblheading"><?php echo $wareh;?><input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_issue['whid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $binn;?><input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_issue['binid'];?>" /></td>
<td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?><input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_issue['subbinid'];?>" /></td>-->
<td colspan="2"  valign="middle">
<div id="slcrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >	
<td align="center" valign="middle" class="tblheading"><input type="text" name="exBagsg<?php echo $srno?>" class="tbltext" value="<?php echo $up;?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
<td align="center" valign="middle" class="tblheading"><input type="text" name="exqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $qt;?>" readonly="true" style="background:#CCCCCC" size="3" /></td>
</table>
</div>
</td>
<td colspan="2"  valign="middle">
<div id="slocrow<?php echo $srno?>">
<table align="center" height="27" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse" >		
<tr>
<td  valign="middle" align="left" class="tbltext">&nbsp;</td>
<td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
<td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="Bags<?php echo $srno;?>" type="text" size="4" class="tbltext" tabindex="" maxlength="7" onkeypress="return isNumberKey(event)" onchange="Bagsf<?php echo $srno;?>(this.value);" value="<?php echo $Bags;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>	
<td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
<td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno;?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno;?>(this.value);" value="<?php echo $qty;?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr></table></div></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balBagsg<?php echo $srno?>" class="tbltext" value="<?php echo $Bags;?>"  size="3" /></td>
<td align="center" valign="middle" class="tbltext"><input type="text" name="balqtyg<?php echo $srno?>" class="tbltext" value="<?php echo $qty;?>" readonly="true" style="background:#CCCCCC" size="3" /></td> <input type="hidden" name="dorowid<?php echo $srno?>" value="<?php echo $row_issue['rowid'];?>" />
</tr>
 <?php 
 }
 $srno++;
 } $ct++;
 }
 }
 ?>

</table>

<input type="hidden" name="cntchk" value="<?php echo $cnt;?>" /><input type="hidden" name="ocnt" value="<?php echo $cnt;?>" />
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/update.gif" border="0"style="display:inline;cursor:pointer;" onclick="pformupdate();" />&nbsp;&nbsp;</td>
</tr>
</table>