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
		$tid = $_GET['a'];	 
	}
	if(isset($_GET['b']))
	{
		$subtid = $_GET['b'];	 
	}
	if(isset($_GET['c']))
	{
		$subsubtid = $_GET['c'];	 
	}
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="15" align="center" class="tblheading">MMC Packaging List</td>
</tr>
<?php
	$sq_mmc2=mysqli_query($link,"Select distinct dmmc_barcode from tbl_dallocmmc where  dalloc_id='$tid' and dmmc_flg=1") or die(mysqli_error($link));
	$tot_mmc=mysqli_num_rows($sq_mmc2);
	
	$sq_mmc1=mysqli_query($link,"Select * from tbl_dallocmmc where  dalloc_id='$tid' and dmmc_flg=2") or die(mysqli_error($link));
	$tot_mmc1=mysqli_num_rows($sq_mmc1);
	$srmc=0;
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="smalltblheading">#</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Barcode</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Net Wt.</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Gross Wt.</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">SLOC</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Crop</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Variety</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Lot No.</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">UPS</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">NoP</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Qty</td>
	<td width="275" align="center"  valign="middle" class="smalltblheading">Status</td>
</tr>
<?php

if($tot_mmc>0)
{
while($row_mmc2=mysqli_fetch_array($sq_mmc2))
{

$mmcbrcd="";$mmcwt="";$mmcgrswt="";$mmccrp="";$mmcver="";$mmcltn="";$mmcup="";$mmcnop="";$mmcqtt="";$mmcsloc="";$mmcsts="";
$sq_mmc=mysqli_query($link,"Select * from tbl_dallocmmc where plantcode='".$plantcode."' and  dalloc_id='$tid' and dmmc_flg=1 and dmmc_barcode='".$row_mmc2['dmmc_barcode']."'") or die(mysqli_error($link));
while($row_mmc=mysqli_fetch_array($sq_mmc))
{

$mmcbrcd=$row_mmc['dmmc_barcode'];
$mmcwt=$row_mmc['dmmc_wtmp'];
$mmcgrswt=$row_mmc['dmmc_grosswt'];

$whd1_query=mysqli_query($link,"select whid, perticulars from tbldbwarehouse where plantcode='".$plantcode."' and  whid='".$row_mmc['dmmc_wh']."' order by perticulars") or die(mysqli_error($link));
$noticia_whd1 = mysqli_fetch_array($whd1_query);

$bind1_query=mysqli_query($link,"select binid, binname from tbldbbin where plantcode='".$plantcode."' and  whid='".$row_mmc['dmmc_wh']."' and binid='".$row_mmc['dmmc_bin']."' order by binname") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bind1_query);

$mmcsloc=$noticia_whd1['perticulars']."/".$noticia_bing1['binname'];


$sq2=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and  dallocs_id='".$row_mmc['dallocs_id']."' and dalloc_id='".$row_mmc['dalloc_id']."'") or die(mysqli_error($link));
$ro2=mysqli_fetch_array($sq2);
if($mmccrp!="")	
$mmccrp=$mmccrp."<br />".$ro2['dallocs_crop'];
else
$mmccrp=$ro2['dallocs_crop'];

if($mmcver!="")	
$mmcver=$mmcver."<br />".$ro2['dallocs_variety'];
else
$mmcver=$ro2['dallocs_variety'];

if($mmcltn!="")	
$mmcltn=$mmcltn."<br />".$row_mmc['dmmc_lotno'];
else
$mmcltn=$row_mmc['dmmc_lotno'];

if($mmcup!="")	
$mmcup=$mmcup."<br />".$row_mmc['dmmc_eups'];
else
$mmcup=$row_mmc['dmmc_eups'];

if($mmcnop!="")	
$mmcnop=$mmcnop."<br />".$row_mmc['dmmc_nolp'];
else
$mmcnop=$row_mmc['dmmc_nolp'];

if($mmcqtt!="")	
$mmcqtt=$mmcqtt."<br />".$row_mmc['dmmc_qty'];
else
$mmcqtt=$row_mmc['dmmc_qty'];

$mmcsts="MMC Slip";
}
$srmc++;
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="smalltbltext"><?php echo $srmc;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcbrcd;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcwt;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcgrswt;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcsloc;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmccrp;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcver;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcltn;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcup;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcnop;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcqtt;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><a href="Javascript:void(0);" onclick="printmmcslip('<?php echo $mmcbrcd;?>');"><?php echo $mmcsts;?></a></td>
</tr>
<?php
}
}
?>
<?php
$totmmcqty=0;
if($tot_mmc1>0)
{
$mmcbrcd="";$mmcwt="";$mmcgrswt="";$mmccrp="";$mmcver="";$mmcltn="";$mmcup="";$mmcnop="";$mmcqtt="";$mmcsloc="";$mmcsts="";
while($row_mmc1=mysqli_fetch_array($sq_mmc1))
{
$mtid=$row_mmc1['dalloc_id'];
$stid=$row_mmc1['dallocs_id'];
$mmcbrcd=$row_mmc1['dmmc_barcode'];
$mmcwt=$row_mmc1['dmmc_wtmp'];
$mmcgrswt=$row_mmc1['dmmc_grosswt'];

$sq2=mysqli_query($link,"Select * from tbl_dalloc_sub where plantcode='".$plantcode."' and  dallocs_id='".$row_mmc1['dallocs_id']."' and dalloc_id='".$row_mmc1['dalloc_id']."'") or die(mysqli_error($link));
$ro2=mysqli_fetch_array($sq2);
if($mmccrp!="")	
$mmccrp=$mmccrp."<br />".$ro2['dallocs_crop'];
else
$mmccrp=$ro2['dallocs_crop'];

if($mmcver!="")	
$mmcver=$mmcver."<br />".$ro2['dallocs_variety'];
else
$mmcver=$ro2['dallocs_variety'];

if($mmcltn!="")	
$mmcltn=$mmcltn."<br />".$row_mmc1['dmmc_lotno'];
else
$mmcltn=$row_mmc1['dmmc_lotno'];

if($mmcup!="")	
$mmcup=$mmcup."<br />".$row_mmc1['dmmc_eups'];
else
$mmcup=$row_mmc1['dmmc_eups'];

if($mmcnop!="")	
$mmcnop=$mmcnop."<br />".$row_mmc1['dmmc_nolp'];
else
$mmcnop=$row_mmc1['dmmc_nolp'];

if($mmcqtt!="")	
$mmcqtt=$mmcqtt."<br />".$row_mmc1['dmmc_qty'];
else
$mmcqtt=$row_mmc1['dmmc_qty'];

$totmmcqty=$totmmcqty+$row_mmc1['dmmc_qty'];
$mmcsloc='';
$mmcsts="Pack MMC";
}
$srmc++;
?>
<tr class="Dark" height="30">
	<td width="205"  align="center"  valign="middle" class="smalltbltext"><?php echo $srmc;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcbrcd;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcwt;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcgrswt;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcsloc;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmccrp;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcver;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcltn;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcup;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcnop;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><?php echo $mmcqtt;?></td>
	<td width="275" align="center"  valign="middle" class="smalltbltext"><a href="Javascript:void(0);" onclick="packmmc('<?php echo $mtid?>','<?php echo $stid?>');"><?php echo $mmcsts;?></a></td>
</tr>
<?php
}
?>
</table>
<br />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="8" align="center" class="tblheading">Barcode Details<input type="hidden" name="eseltyp" value="mmcbarsel" /></td>
</tr>
<tr class="Light" height="20">
  <td align="right" class="tblheading">Barcode&nbsp;</td>
  <td align="left" valign="middle" class="tbltext">&nbsp;<input type="text" name="barcode" id="txtbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onChange="chkbarcode1(this.value)" />&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
  <td align="right" class="tblheading">Net Weight&nbsp;</td>
  <td align="left" valign="middle" class="tbltext">&nbsp;<input type="text" name="mmcnetwt" size="6" maxlength="6" class="smalltbltext" value="<?php echo $totmmcqty;?>" readonly="true" style="background-color:#CCCCCC" />&nbsp;Kgs.</td>
  <td align="right" class="tblheading">Gross Weight&nbsp;</td>
  <td align="left" valign="middle" class="tbltext">&nbsp;<input type="text" name="mmcgrwt" size="6" maxlength="6" class="smalltbltext" value="" onkeypress="return isNumberKey(event)" onchange="chkgrwt(this.value);"  />&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;Kgs.</td>
  <td align="right" class="tblheading">MP Type&nbsp;</td>
   <td align="left" valign="middle" class="tbltext">&nbsp;<select name="mptyp" class="tbltext" style="size:60px;" onchange="chkgrwt2();">
   <option value="" selected="selected">Select</option>
   <option value="Carton" >Carton</option>
   <option value="Bag">Bag</option>
   </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
</tr>
<div id="barchk"><input type="hidden" name="brflg" value="" /><input type="hidden" name="brchflg" value="0" /></div>
</table>
<br />

<?php
	$tot4=0;  $tsln=0;
	$sq42=mysqli_query($link,"Select distinct dmmc_bin, dmmc_wh from tbl_dallocmmc where plantcode='".$plantcode."' and  dalloc_id='$tid' and dmmc_flg=1") or die(mysqli_error($link));
	$tot4=mysqli_num_rows($sq42);
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td width="50%" align="right" class="tblheading">Bin Shifting&nbsp;</td>
  <td align="left" valign="middle" class="tblheading"><input type="radio" name="binshift" value="yes" checked="checked"  />&nbsp;Yes&nbsp;&nbsp;<input type="radio" name="binshift" value="no"  disabled="disabled" />&nbsp;No&nbsp;<font color="#FF0000">*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="barcupload" ></span><input type="hidden" name="bcvalues" value="" /></td>
</tr>
<input type="hidden" name="binshifting" value="yes" /><input type="hidden" name="nslval" value="<?php echo $tot4;?>"  /><input type="hidden" name="nbarallval" value="0"  /><input type="hidden" name="nbarallnos" value=""  />
</table>
<div id="shownsloc" style="display:block">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="tblsubtitle" height="20">
  <td colspan="10" align="center" class="tblheading">SLOC Details</td>
</tr>
<tr class="Light" height="25">
	<td width="40" align="center" class="smalltblheading">#</td>
	<td width="243" align="center" class="smalltblheading">WH</td>
	<td width="270" align="center" class="smalltblheading">Bin</td>
  	<td width="190" align="center" class="smalltblheading">NoMP</td>
 	<td width="195" align="center" class="smalltblheading">Qty</td>
</tr>
<?php
if($tot4>0)
{
$sln=0;
while($ro4=mysqli_fetch_array($sq42))
{
$nb=0;
$mbqt=0;
$sq4=mysqli_query($link,"Select * from tbl_dallocmmc where plantcode='".$plantcode."' and  dalloc_id='$tid' and dmmc_flg=1 and dmmc_bin='".$ro4['dmmc_bin']."'") or die(mysqli_error($link));
while($ro42=mysqli_fetch_array($sq4))
{
	$mbqt=$mbqt+$ro42['dmmc_qty'];
}
$sq43=mysqli_query($link,"Select distinct dmmc_barcode from tbl_dallocmmc where plantcode='".$plantcode."' and  dalloc_id='$tid' and dmmc_flg=1 and dmmc_bin='".$ro4['dmmc_bin']."'") or die(mysqli_error($link));
while($ro43=mysqli_fetch_array($sq43))
{
	$nb++;
}
	$sln++;
?>
<tr class="light" height="25">
<td width="40" align="center" class="smalltbltext"><?php echo $sln;?></td>
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbldbwarehouse where plantcode='".$plantcode."' and  whid='".$ro4['dmmc_wh']."' order by perticulars") or die(mysqli_error($link));
$noticia_whd1 = mysqli_fetch_array($whd1_query);
?>
<td width="243" align="center"  valign="middle" class="smalltbltext"><?php echo $noticia_whd1['perticulars'];?><input type="hidden" name="txtwhg<?php echo $sln;?>" id="txtwhg<?php echo $sln;?>" value="<?php echo $noticia_whd1['whid'];?>"  /><!--<select class="smalltbltext" id="txtwhg<?php echo $sln;?>" name="txtwhg<?php echo $sln;?>" style="width:70px;" onchange="wh(this.value,<?php echo $sln;?>);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;--></td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbldbbin where plantcode='".$plantcode."' and  whid='".$ro4['dmmc_wh']."' and binid='".$ro4['dmmc_bin']."' order by binname") or die(mysqli_error($link));
$noticia_bing1 = mysqli_fetch_array($bind1_query);
?>
<td width="270" align="center"  valign="middle" class="smalltbltext" id="bingn<?php echo $sln;?>"><?php echo $noticia_bing1['binname'];?><input type="hidden" name="txtbing<?php echo $sln;?>" id="txtbing<?php echo $sln;?>" value="<?php echo $noticia_bing1['binid'];?>"  /><!--<select class="smalltbltext" name="txtbing<?php echo $sln;?>" id="txtbing<?php echo $sln;?>" style="width:60px;" onchange="bin(this.value,<?php echo $sln;?>);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;--></td>
<td width="190" align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="bnnomps_<?php echo $sln;?>" id="bnnomps_<?php echo $sln;?>" value="<?php echo $nb;?>" size="9" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" name="nbinnomps_<?php echo $sln;?>" id="nbinnomps_<?php echo $sln;?>" value="<?php echo $nb;?>" /></td>
<td width="195" align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="bnqtys_<?php echo $sln;?>" id="bnqtys_<?php echo $sln;?>" value="<?php echo $mbqt;?>" size="9" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" name="nbinqtys_<?php echo $sln;?>" id="nbinqtys_<?php echo $sln;?>" value="<?php echo $mbqt;?>" /></td>
</tr>
<?php
}
}
else
{
$sln=1;
?>
<tr class="light" height="25">
<td width="40" align="center" class="smalltbltext"><?php echo $sln;?></td>
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbldbwarehouse where plantcode='".$plantcode."' order by perticulars") or die(mysqli_error($link));
?>
<td width="243" align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg<?php echo $sln;?>" name="txtwhg<?php echo $sln;?>" style="width:70px;" onchange="wh(this.value,<?php echo $sln;?>);"  >
<!--<option value="" selected>WH</option>-->
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" selected="selected" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbldbbin where plantcode='".$plantcode."' order by binname") or die(mysqli_error($link));
?>
<td width="270" align="center"  valign="middle" class="smalltbltext" id="bingn<?php echo $sln;?>"><select class="smalltbltext" name="txtbing<?php echo $sln;?>" id="txtbing<?php echo $sln;?>" style="width:60px;" onchange="bin(this.value,<?php echo $sln;?>);" >
<option value="" selected>Bin</option>
<?php while($noticia_bing1 = mysqli_fetch_array($bind1_query)) { ?>
		<option value="<?php echo $noticia_bing1['binid'];?>" />   
		<?php echo $noticia_bing1['binname'];?>
		<?php } ?>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="190" align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="bnnomps_<?php echo $sln;?>" id="bnnomps_<?php echo $sln;?>" value="" size="9" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" name="nbinnomps_<?php echo $sln;?>" id="nbinnomps_<?php echo $sln;?>" value="0" /></td>
<td width="195" align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="bnqtys_<?php echo $sln;?>" id="bnqtys_<?php echo $sln;?>" value="" size="9" readonly="true" style="background-color:#CCCCCC" /><input type="hidden" name="nbinqtys_<?php echo $sln;?>" id="nbinqtys_<?php echo $sln;?>" value="0" /></td>
</tr>
<?php 
} 
?>
</table>
<?php
$tsln=$sln;
while($sln<5)
{
$sln++;
?>
<div id="nwslocs<?php echo $sln;?>" style="display:none">
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="light" height="25">
<td width="40" align="center" class="smalltbltext"><?php echo $sln;?></td>
<?php
$whd1_query=mysqli_query($link,"select whid, perticulars from tbldbwarehouse order by perticulars") or die(mysqli_error($link));
?>
<td width="243" align="center"  valign="middle" class="smalltbltext"><select class="smalltbltext" id="txtwhg<?php echo $sln;?>" name="txtwhg<?php echo $sln;?>" style="width:70px;" onchange="wh(this.value,<?php echo $sln;?>);"  >
<option value="" selected>WH</option>
	<?php while($noticia_whd1 = mysqli_fetch_array($whd1_query)) { ?>
		<option value="<?php echo $noticia_whd1['whid'];?>" />   
		<?php echo $noticia_whd1['perticulars'];?>
		<?php } ?>
	</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<?php
$bind1_query=mysqli_query($link,"select binid, binname from tbldbbin where plantcode='".$plantcode."' order by binname") or die(mysqli_error($link));
?>
<td width="270" align="center"  valign="middle" class="smalltbltext" id="bingn<?php echo $sln;?>"><select class="smalltbltext" name="txtbing<?php echo $sln;?>" id="txtbing<?php echo $sln;?>" style="width:60px;" onchange="bin(this.value,<?php echo $sln;?>);" >
<option value="" selected>Bin</option>
</select>&nbsp;<font color="#FF0000" >* </font>&nbsp;</td>
<td width="190" align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="bnnomps_<?php echo $sln;?>" id="bnnomps_<?php echo $sln;?>" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
<td width="195" align="center" valign="middle" class="tbltext"><input type="text" class="tbltext" name="bnqtys_<?php echo $sln;?>" id="bnqtys_<?php echo $sln;?>" value="" size="9" readonly="true" style="background-color:#CCCCCC" /></td>
</tr>
</table>
</div>
<?php 
}
?>
<input type="hidden" name="sln" value="<?php echo $sln;?>"  /><input type="hidden" name="tsln" value="<?php echo $tsln;?>"  />
</table>
<table align="center" border="0" width="950" cellspacing="0" cellpadding="0" bordercolor="#378b8b" style="border-collapse:collapse" > 
<tr class="Light" height="20">
  <td colspan="7" align="right" class="tblheading"><?php if($tsln<5) {?><a href="Javascript:void(0);" onclick="addnewsl(<?php echo $tsln+1;?>)">ADD New Bin...</a>&nbsp;<?php } ?></td>
</tr>
</table>
<input type="hidden" name="totnewsloc" value="0" /><input type="hidden" name="newsloc" value="" /><input type="hidden" name="newslocsel" value="" />
</div>
<input type="hidden" name="maintrid" value="<?php echo $tid?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" /><input type="hidden" name="subsubtrid" value="<?php echo $subsubtid;?>" />
</div>
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right" id="frmbutn"><img src="../images/update.gif" border="0"style="display:inline;cursor:Pointer;" onClick="pmmcup();" />&nbsp;&nbsp;</td>
</tr>
</table>
