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
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse"  cols="2">
  <tr class="tblsubtitle">
    <td width="70" align="center" valign="middle" class="tblheading" >#</td>
	<td width="318" align="center" valign="middle" class="tblheading">Lot No.</td>
	  <td width="296" align="center" valign="middle" class="tblheading">SLOC</td>
	   <td width="256" align="center" valign="middle" class="tblheading">NoMP</td>
	   <td width="256" align="center" valign="middle" class="tblheading">Qty</td>
  </tr>
<?php
$srno=1; $cnt=0; $cropt="";$vert=""; $crpflg=0; $verflg=0;
$sql_iss=mysqli_query($link,"select distinct (lotno)  from tbl_lot_ldg_pack where plantcode='$plantcode' and lotldg_crop='".$b."' and lotldg_variety='".$c."' and packtype='".$a."' order by lotno") or die(mysqli_error($link));
$tot=mysqli_num_rows($sql_iss);
while($row_iss=mysqli_fetch_array($sql_iss))
{ 
$nomp=0; $qty=0;$sloc=""; 
$sql_iss23=mysqli_query($link,"select distinct (subbinid)  from tbl_lot_ldg_pack where plantcode='$plantcode' and lotno='".$row_iss['lotno']."' order by subbinid") or die(mysqli_error($link));
$tot23=mysqli_num_rows($sql_iss23);
while($row_iss23=mysqli_fetch_array($sql_iss23))
{ 

$sql_issue1=mysqli_query($link,"select max(lotdgp_id) from tbl_lot_ldg_pack where plantcode='$plantcode' and subbinid='".$row_iss23['subbinid']."' and lotno='".$row_iss['lotno']."' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg_pack where plantcode='$plantcode' and lotdgp_id='".$row_issue1[0]."' and balqty>0 and lotldg_dispflg!=1 and lotldg_rvflg=0 and lotldg_spremflg=0") or die(mysqli_error($link)); 
while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{ 

$lot=$row_issuetbl['lotno'];

$nomp=$nomp+$row_issuetbl['balnomp'];

$qty=$qty+$row_issuetbl['balqty'];

$sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' and whid='".$row_issuetbl['whid']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars']."/";

$sql_binn=mysqli_query($link,"select binname from tbl_bin where plantcode='$plantcode' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname']."/";
//$binn=$row_binn[binname];


$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' and sid='".$row_issuetbl['subbinid']."' and binid='".$row_issuetbl['binid']."' and whid='".$row_issuetbl['whid']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
//$subbinn="<a href='Javascript:void(0)' onclick='openprintsubbin($row_tbl_sub[subbinid],$row_tbl_sub[binid],$row_tbl_sub[whid])'>$row_subbinn[sname]</a>";
$subbinn=$row_subbinn['sname'];

if($sloc!="")
$sloc=$sloc.$wareh.$binn.$subbinn."<br/>";
else
$sloc=$wareh.$binn.$subbinn."<br/>";

}
}
$sql_crop=mysqli_query($link,"Select * from tblcrop where cropid='".$row_issuetbl['lotldg_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crp=$row_crop['cropname'];
$sql_veriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$row_issuetbl['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$row_veriety=mysqli_fetch_array($sql_veriety);
$vv=$row_veriety['popularname'];

$sql_sbn2=mysqli_query($link,"select sid, sname from tbl_subbin where plantcode='$plantcode' and sid='".$a."' order by sname")or die("Error:".mysqli_error($link));
$row_sbn2=mysqli_fetch_array($sql_sbn2);
	
	$cnt++; 
if($nomp<=0) $nomp=0;
if($qty<=0)$qty=0;
if($qty<=0)$nomp=0;
if($qty > 0)
{	
if($srno%2!=0)
{
?> 
<tr class="Light" height="30">
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="318"  align="center"  valign="middle"><?php echo $lot;?>&nbsp;<input type="hidden" name="lotsn" id="lotsn<?php echo $srno;?>" value="<?php echo $lot;?>" /></td>
	<td width="296"  align="center"  valign="middle"><?php echo $sloc;?></td>
	<td width="256"  align="center"  valign="middle"><?php echo $nomp;?></td>
	<td width="256"  align="center"  valign="middle"><?php echo $qty;?></td>
</tr>
 <?php
}
else
{
?>
<tr class="Light" height="30">
	<td width="70" align="center" valign="middle" class="tblheading"><?php echo $srno;?></td>
	<td width="318"  align="center"  valign="middle"><?php echo $lot;?>&nbsp;<input type="hidden" name="lotsn" id="lotsn<?php echo $srno;?>" value="<?php echo $lot;?>" /></td>
	<td width="296"  align="center"  valign="middle"><?php echo $sloc;?></td>
	<td width="256"  align="center"  valign="middle"><?php echo $nomp;?></td>
	<td width="256"  align="center"  valign="middle"><?php echo $qty;?></td>
</tr>
<?php
}
$srno=$srno+1;
}
}

?>

<input type="hidden" name="cnt" value="<?php echo $cnt;?>" /><input type="hidden" name="crpflg" value="<?php echo $crpflg;?>" /><input type="hidden" name="cropt" value="<?php echo $cropt;?>" /><input type="hidden" name="verflg" value="<?php echo $verflg;?>" /><input type="hidden" name="vert" value="<?php echo $vert;?>" /><input type="hidden" name="stageflg" value="<?php echo $stageflg;?>" /><input type="hidden" name="stage" value="Pack" />
 </table>
<?php

if($cnt>0)
{
?><br />
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse"> <tr class="tblsubtitle">
    <td align="center" valign="middle" class="tblheading" colspan="6">Select New SLOC</td>
  </tr>
<tr class="Dark" height="25">
	<td width="159" height="30" align="right" valign="middle" class="tblheading">Select Ware House&nbsp;</td>
  <?php
$whg24_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='$plantcode' order by perticulars");
?>                 
				<td width="149"  align="left"  valign="middle">&nbsp;<select class="tbltext" name="txtslwhg24" style="width:80px;" onChange="wh4(this.value);"   >
            <option value="" selected>--WH--</option>
            <?php while($noticia_whg24=mysqli_fetch_array($whg24_query)) { ?>
            <option value="<?php echo $noticia_whg24['whid'];?>" />    
            <?php echo $noticia_whg24['perticulars'];?>
            <?php } ?>
    </select><font color="#FF0000">*</font>&nbsp;</td>
    <td width="120" height="30" align="right" valign="middle" class="tblheading">Select Bin&nbsp;</td>
                  
    <td width="194"  align="left"  valign="middle" class="tbltext" id="bing24">&nbsp;<select class="tbltext" name="txtslbing24" style="width:80px;"  >
     <option value="" selected>--Bin--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	
	    <td width="117" height="30" align="right" valign="middle" class="tblheading">Select Sub Bin&nbsp;</td>
                  
    <td width="197"  align="left"  valign="middle" class="tbltext" id="sbing24">&nbsp;<select class="tbltext" name="txtslsubbing24" style="width:80px;"  >
     <option value="" selected>--SubBin--</option>
    </select>&nbsp;<font color="#FF0000">*</font>&nbsp;</td>
	
</tr>
</table>
<div id="prvewshow">
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_sloc1.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');"/></a>&nbsp;</td>
</tr>
</table>
</div>
<?php
}
else if($cntflg>0)
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse">
<tr class="Light">
	<td align="center" valign="middle" class="tblheading" ><font color="#FF0000">Records with different Veriety/Stage found in selected Bin. Shift them first then try again.</font></td>
</tr>
</table> 
<div id="prvewshow">
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_sloc1.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');"/></a>&nbsp;</td>
</tr>
</table> 
</div>
<?php
}
else
{
?>
<table align="center" border="1" width="850" cellspacing="0" cellpadding="0" bordercolor="#0BC5F4" style="border-collapse:collapse">
<tr class="tblsubtitle">
	<td align="center" valign="middle" class="tblheading" >Records Not Found.</td>
</tr>
</table> 
<div id="prvewshow">
<table align="center" width="850" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="home_sloc1.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');"/></a>&nbsp;</td>
</tr>
</table> 
</div>
<?php
}
?>