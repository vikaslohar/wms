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
	$rid = $_GET['g'];	 
	}

?>

<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
  <tr class="tblsubtitle" height="20">
    <td colspan="7" align="center" class="tblheading">Storage Location(SLOC) </td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td colspan="3" align="center" valign="middle" class="tblheading">Existing SLOC </td>
    <td width="331" rowspan="2" align="center" valign="middle" class="tblheading">View</td>
    <td width="301" rowspan="2" align="center" valign="middle" class="tblheading">Arrival</td>
  </tr>
  <tr class="tblsubtitle" height="20">
    <td width="98" align="center" valign="middle" class="tblheading">WH</td>
    <td width="84" align="center" valign="middle" class="tblheading">Bin</td>
    <td width="103" align="center" valign="middle" class="tblheading">SuB Bin</td>
  </tr>
  <?php

//$c=$row_tbl_sub['classification_id'];
//$f=$row_tbl_sub['item_id'];
//$ba=0;
//$up=0;
$sql_sub_sloc=mysqli_query($link,"select * from tblarr_sloc where plantcode='".$plantcode."' and   arr_id='".$a."' order by arrsloc_id") or die(mysqli_error($link));
$tot_sub_sloc=mysqli_num_rows($sql_sub_sloc);
/*$sql_sub_sloc1=mysqli_query($link,"select whid,binid,subbin from tblarr_sloc where arr_id='".$rid."' and qty_good=0 and ups_good=0") or die(mysqli_error($link));
echo $tot_sub_sloc1=mysqli_num_rows($sql_sub_sloc1);*/
$srno=1;
while($row_sub_sloc=mysqli_fetch_array($sql_sub_sloc))
{

$wareh=""; $binn=""; $subbinn=""; $sups="";$sqty=0; $slocs=""; $gd=""; $slups=0; $slqty=0;
$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='".$plantcode."' and   whid='".$row_sub_sloc['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='".$plantcode."' and   binid='".$row_sub_sloc['binid']."' and whid='".$row_sub_sloc['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='".$plantcode."' and   sid='".$row_sub_sloc['subbin']."' and binid='".$row_sub_sloc['binid']."' and whid='".$row_sub_sloc['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

/*$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_subbinid='".$row_sub_sloc['subbin']."' and lotldg_binid='".$row_sub_sloc['binid']."' and lotldg_whid='".$row_sub_sloc['whid']."' and lotldg_varietyid='".$f."'") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and   stlg_id='".$row_issue1[0]."'") or die(mysqli_error($link)); 
//echo $t=mysqli_num_rows($sql_issuetbl);
 while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
 { 
$up=$row_issuetbl['lotldg_balbags'];
$ba=$row_issuetbl['lotldg_balqty'];
}
*/
$s_good_new=mysqli_query($link,"select distinct lotldg_whid, lotldg_subbinid, lotldg_binid from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_subbinid='".$row_sub_sloc['subbin']."'") or die(mysqli_error($link));
//$r_good_new=mysqli_fetch_array($s_good_new);
$row_issueg_new=mysqli_fetch_array($s_good_new);

	$sql_issueg1_new=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_subbinid='".$row_issueg_new['lotldg_subbinid']."' and lotldg_binid='".$row_issueg_new['lotldg_binid']."' and lotldg_whid='".$row_issueg_new['lotldg_whid']."'") or die(mysqli_error($link));
	$row_issueg1_new=mysqli_fetch_array($sql_issueg1_new); 
	
	$sql_issuetblg_new=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and   lotldg_id='".$row_issueg1_new[0]."' and lotldg_balqty > 0") or die(mysqli_error($link)); 
	$totno_new=mysqli_num_rows($sql_issuetblg_new);
	
	if($totno_new > 0)
	{
		$row_issuetblg_new=mysqli_fetch_array($sql_issuetblg_new);
		if($row_issuetblg_new['lotldg_varietyid']=="Fresh Seed with PDN")
		{
		$details="<a href='Javascript:void(0)' onclick='openprintsubbin($row_issuetblg_new[lotldg_subbinid],$row_issuetblg_new[lotldg_binid],$row_issuetblg_new[lotldg_whid],$row_issuetblg_new[lotldg_id])'>Details</a>";
		$existview=$row_issuetblg_new['lotldg_crop'].", ".$row_issuetblg_new['lotldg_variety'].", ".$row_issuetblg_new['lotldg_sstage'].", ".$details;
		
		}
		else
		{
		$sql_crop_new=mysqli_query($link,"select * from tblcrop where cropid='".$row_issuetblg_new['lotldg_crop']."'") or die(mysqli_error($link));
		$row_crop_new=mysqli_fetch_array($sql_crop_new);
		
		$sql_variety_new=mysqli_query($link,"select * from tblvariety where varietyid='".$row_issuetblg_new['lotldg_variety']."' and actstatus='Active' and vertype='PV'") or die(mysqli_error($link));
		$row_variety_new=mysqli_fetch_array($sql_variety_new);
		
		$details="<a href='Javascript:void(0)' onclick='openprintsubbin($row_issuetblg_new[lotldg_subbinid],$row_issuetblg_new[lotldg_binid],$row_issuetblg_new[lotldg_whid],$row_issuetblg_new[lotldg_id])'>Details</a>";
		$existview=$row_crop_new['cropname'].", ".$row_variety_new['popularname'].", ".$row_issuetblg_new['lotldg_sstage'].", ".$details;
		}
	
	}
	else
	{
	$existview="Empty";
	}

if($srno%2!=0)
{

?>
  <tr class="Light" height="25">
    <td align="center" valign="middle" class="tblheading"><?php echo $wareh;?>
        <input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_sub_sloc['whid'];?>" /></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $binn;?>
        <input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_sub_sloc['binid'];?>" /></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?>
        <input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_sub_sloc['subbin'];?>" /></td>
    <td colspan="2"  valign="middle"><div id="slocrow<?php echo $srno?>">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
        <tr>
          <td  valign="middle" align="left" class="tbltext">&nbsp;
                <?php echo $existview;?></td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['bags'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['qty'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid<?php echo $srno?>" value="<?php echo $row_sub_sloc['rowid'];?>" />
  </tr>
  <?php
 }
 else
 {
 ?>
  <tr class="Dark" height="25">
    <td align="center" valign="middle" class="tblheading"><?php echo $wareh;?>
        <input type="hidden" name="txtslwhg<?php echo $srno?>" value="<?php echo $row_sub_sloc['whid'];?>" /></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $binn;?>
        <input type="hidden" name="txtslbing<?php echo $srno?>" value="<?php echo $row_sub_sloc['binid'];?>" /></td>
    <td align="center" valign="middle" class="tblheading"><?php echo $subbinn;?>
        <input type="hidden" name="txtslsubbg<?php echo $srno?>" value="<?php echo $row_sub_sloc['subbin'];?>" /></td>
    <td colspan="2"  valign="middle"><div id="slocrow<?php echo $srno?>">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
        <tr>
          <td  valign="middle" align="left" class="tbltext">&nbsp;
                <?php echo $existview;?></td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg<?php echo $srno?>" id="ups<?php echo $srno?>" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['bags'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg<?php echo $srno?>" id="qty<?php echo $srno?>" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf<?php echo $srno?>(this.value);" value="<?php echo $row_sub_sloc['qty'];?>"  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid<?php echo $srno?>" value="<?php echo $row_sub_sloc['rowid'];?>" />
  </tr>
  <?php 
 }
 $srno++;
 } 
?>
  <?php

if($tot_sub_sloc==0)
{
?>
<?php
$whg1_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode=$plantcode order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30" >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;
        <select class="tbltext" name="txtslwhg1" style="width:70px;" onchange="wh1(this.value);"  >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg1 = mysqli_fetch_array($whg1_query)) { ?>
          <option value="<?php echo $noticia_whg1['whid'];?>" />  
          <?php echo $noticia_whg1['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing1_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode=$plantcode") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing1">&nbsp;
        <select class="tbltext" name="txtslbing1" style="width:60px;" onchange="bin1(this.value);" >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing1_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode=$plantcode") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing1">&nbsp;
        <select class="tbltext" name="txtslsubbg1" style="width:80px;" onchange="subbin1(this.value);"  >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow1">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
        <tr>
		<td  valign="middle">&nbsp;</td>
          <td align="right" width="47"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td  align="left" width="94"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg1" id="Bags1" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td  align="right" width="44"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg1" id="qty1" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf1(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode=$plantcode order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;
        <select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode=$plantcode") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;
        <select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode=$plantcode") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;
        <select class="tbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin2(this.value);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
        <tr>
		<td  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>
  <?php
}
else if($tot_sub_sloc==1)
{
?>
  <?php
$whg2_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode=$plantcode order by perticulars") or die(mysqli_error($link));
?>
  <tr class="Light" height="30"  >
    <td width="100" align="center"  valign="middle" class="tbltext">&nbsp;
        <select class="tbltext" name="txtslwhg2" style="width:70px;" onchange="wh2(this.value);" >
          <option value="" selected>--WH--</option>
          <?php while($noticia_whg2 = mysqli_fetch_array($whg2_query)) { ?>
          <option value="<?php echo $noticia_whg2['whid'];?>" />  
          <?php echo $noticia_whg2['perticulars'];?>
          <?php } ?>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$bing2_query=mysqli_query($link,"select binid, binname from tbl_bin where plantcode=$plantcode") or die(mysqli_error($link));
?>
    <td width="93" align="center"  valign="middle" class="tbltext" id="bing2">&nbsp;
        <select class="tbltext" name="txtslbing2" style="width:60px;" onchange="bin2(this.value);"  >
          <option value="" selected>--Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    <?php
$subbing2_query=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode=$plantcode") or die(mysqli_error($link));
?>
    <td width="113" align="center"  valign="middle" class="tbltext" id="sbing2">&nbsp;
        <select class="tbltext" name="txtslsubbg2" style="width:80px;" onchange="subbin2(this.value);" >
          <option value="" selected>--Sub Bin--</option>
        </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
    
    <td colspan="2"  valign="middle"><div id="slocrow2">
      <table align="center" height="30" width="100%"  border="1" cellspacing="0" cellpadding="0" bordercolor="#adad11" style="border-collapse:collapse" >
        <tr>
		<td  valign="middle">&nbsp;</td>
          <td width="47" align="right"  valign="middle" class="tblheading">&nbsp;NoB &nbsp;</td>
          <td width="94" align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslBagsg2" id="Bags2" type="text" size="4" class="tbltext" tabindex="" maxlength="4" onkeypress="return isNumberKey1(event)" onchange="Bagsf2(this.value);" value=""  />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
          <td width="44" align="right"  valign="middle" class="tblheading">&nbsp;Qty &nbsp;</td>
          <td width="106"  align="left"  valign="middle" class="tbltext">&nbsp;<input name="txtslqtyg2" id="qty2" type="text" size="9" class="tbltext" tabindex="" maxlength="9" onkeypress="return isNumberKey(event)" onchange="qtyf2(this.value);" value=""   />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
        </tr>
      </table>
    </div></td>
    <input type="hidden" name="orowid2" value="0" />
  </tr>
  <?php
}
?>
</table>
