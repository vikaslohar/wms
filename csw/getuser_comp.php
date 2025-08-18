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
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse"  cols="2">
<tr class="tblsubtitle">
	<td width="70" align="center" valign="middle" class="tblheading" ><a href="Javascript:void(0);" onclick="chkall();">CA</a> / <a href="Javascript:void(0);" onclick="clrall();">CL</a></td>
	<td width="318" align="center" valign="middle" class="tblheading">Crop</td>
	<td width="296" align="center" valign="middle" class="tblheading">Variety</td>
	<td width="256" align="center" valign="middle" class="tblheading">Stage</td>
	<td width="256" align="center" valign="middle" class="tblheading">Lot No.</td>
	<td width="56" align="center" valign="middle" class="tblheading">NoB</td>
	<td width="56" align="center" valign="middle" class="tblheading">Qty</td>
</tr>
<?php
$srno=1; $cnt=0; $cropt="";$vert=""; $crpflg=0; $verflg=0; $stage=""; $stageflg=0; $stg="Condition";
$sql_iss=mysqli_query($link,"select distinct (lotldg_lotno)  from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_whid='".$b."' and lotldg_binid='".$c."' and lotldg_subbinid='".$a."' and lotldg_sstage='$stg'") or die(mysqli_error($link));
$tot=mysqli_num_rows($sql_iss);
while($row_iss=mysqli_fetch_array($sql_iss))
{ 

$sql_issue1=mysqli_query($link,"select max(lotldg_id) from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_subbinid='".$a."' and lotldg_binid='".$c."' and lotldg_whid='".$b."' and lotldg_lotno='".$row_iss['lotldg_lotno']."' and lotldg_sstage='$stg' ") or die(mysqli_error($link));
$row_issue1=mysqli_fetch_array($sql_issue1); 

$sql_issuetbl=mysqli_query($link,"select * from tbl_lot_ldg where plantcode='".$plantcode."' and lotldg_id='".$row_issue1[0]."' and lotldg_balqty>0 and lotldg_sstage='$stg'") or die(mysqli_error($link)); 
while($row_issuetbl=mysqli_fetch_array($sql_issuetbl))
{ 
$cnt++;
$lot=$row_issuetbl['lotldg_lotno'];
if($cropt=="")
{
$cropt=$row_issuetbl['lotldg_crop'];
}
else
{
if($cropt!=$row_issuetbl['lotldg_crop'])
$crpflg++;
}
if($vert=="")
{
$vert=$row_issuetbl['lotldg_variety'];
}
else
{
if($vert!=$row_issuetbl['lotldg_variety'])
$verflg++;
}
if($stage=="")
{
$stage=$row_issuetbl['lotldg_sstage'];
}
else
{
if($stage!=$row_issuetbl['lotldg_sstage'])
$stageflg++;
if($stg!=$stage)
$stageflg++;
}
$sql_crop=mysqli_query($link,"Select * from tblcrop where cropid='".$row_issuetbl['lotldg_crop']."'") or die(mysqli_error($link));
$row_crop=mysqli_fetch_array($sql_crop);
$crp=$row_crop['cropname'];
$sql_veriety=mysqli_query($link,"Select * from tblvariety where varietyid='".$row_issuetbl['lotldg_variety']."' and actstatus='Active'") or die(mysqli_error($link));
$row_veriety=mysqli_fetch_array($sql_veriety);
$vv=$row_veriety['popularname'];

if($srno%2!=0)
{
?> 
<tr class="Light" height="30">
	<td width="70" align="center" valign="middle" class="tblheading"><input type="checkbox" name="lotsn" id="lotsn<?php echo $srno;?>" value="<?php echo $lot;?>" /></td>
	<td width="318"  align="center"  valign="middle">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="296"  align="center"  valign="middle">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="256"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_sstage'];?>&nbsp;</td>
	<td width="256"  align="center"  valign="middle">&nbsp;<?php echo $lot;?>&nbsp;<input type="hidden" name="lotsn" id="lotsn" value="<?php echo $lot;?>" /></td>
	<td width="56"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_balbags'];?>&nbsp;</td>
	<td width="56"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_balqty'];?>&nbsp;</td>
</tr>
 <?php
}
else
{
?>
<tr class="Light" height="30">
	<td width="70" align="center" valign="middle" class="tblheading"><input type="checkbox" name="lotsn" id="lotsn<?php echo $srno;?>" value="<?php echo $lot;?>" /></td>
	<td width="318"  align="center"  valign="middle">&nbsp;<?php echo $crp;?>&nbsp;</td>
	<td width="296"  align="center"  valign="middle">&nbsp;<?php echo $vv;?>&nbsp;</td>
	<td width="256"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_sstage'];?>&nbsp;</td>
	<td width="256"  align="center"  valign="middle">&nbsp;<?php echo $lot;?>&nbsp;<input type="hidden" name="lotsn" value="<?php echo $lot;?>" /></td>
	<td width="56"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_balbags'];?>&nbsp;</td>
	<td width="56"  align="center"  valign="middle">&nbsp;<?php echo $row_issuetbl['lotldg_balqty'];?>&nbsp;</td>
</tr>
<?php
}
$srno=$srno+1;
}
}
?>
<input type="hidden" name="cnt" value="<?php echo $cnt;?>" /><input type="hidden" name="crpflg" value="<?php echo $crpflg;?>" /><input type="hidden" name="cropt" value="<?php echo $cropt;?>" /><input type="hidden" name="verflg" value="<?php echo $verflg;?>" /><input type="hidden" name="vert" value="<?php echo $vert;?>" /><input type="hidden" name="stageflg" value="<?php echo $stageflg;?>" /><input type="hidden" name="stage" value="<?php echo $stage;?>" /><input type="hidden" name="srno" value="<?php echo $srno;?>" />
 </table>
<?php
if($cnt>0)
{
?><br />
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse"> <tr class="tblsubtitle">
    <td align="center" valign="middle" class="tblheading" colspan="6">Select New SLOC</td>
  </tr>
<tr class="Dark" height="25">
	<td width="159" height="30" align="right" valign="middle" class="tblheading">Select Ware House&nbsp;</td>
  <?php
$whg24_query=mysqli_query($link,"select whid, perticulars from tbl_warehouse where plantcode='".$plantcode."' order by perticulars");
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
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="add_sloc_binw.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');"/></a>&nbsp;</td>
</tr>
</table>
</div>
<?php
}
else
{
?>
<table align="center" border="1" width="750" cellspacing="0" cellpadding="0" bordercolor="#fa8283" style="border-collapse:collapse">
<tr class="tblsubtitle">
	<td align="center" valign="middle" class="tblheading" >Records Not Found.</td>
</tr>
</table> 
<div id="prvewshow">
<table align="center" width="750" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><a href="add_sloc_binw.php"><img src="../images/cancel.gif" border="0"  style="display:inline;cursor:pointer;" onclick="return confirm('Do You wish to Cancel this Transaction?');"/></a>&nbsp;</td>
</tr>
</table> 
</div>
<?php
}
?>