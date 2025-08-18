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
  		$trid = $_GET['b'];	 
	}
	if(isset($_GET['c']))
	{
  		$typ = $_GET['c'];	 
	}
	if(isset($_GET['f']))
	{
  		$wh24 = $_GET['f'];	 
	}
	if(isset($_GET['g']))
	{
  		$bin24 = $_GET['g'];	 
	}
	if(isset($_GET['h']))
	{
  		$sbin24 = $_GET['h'];	 
	}

	$sql_btslm=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_barcode='$a' order by btslsub_id asc") or die(mysqli_error($link));
	$ttoott=mysqli_num_rows($sql_btslm);
	while($row_btslm=mysqli_fetch_array($sql_btslm))
	{
		if($row_btslm['btslsub_bctype']=="Identified")
		{
			$sql_btsls2="delete from tbl_srbtslsub_sub where btslsub_id='".$row_btslm['btslsub_id']."'";
			$xcxc=mysqli_query($link,$sql_btsls2) or die(mysqli_error($link));
		}
		else
		{
			$sql_btsls2="delete from tbl_srbtslsub_sub2 where btslsub_id='".$row_btslm['btslsub_id']."'";
			$xcxc=mysqli_query($link,$sql_btsls2) or die(mysqli_error($link));
		}
	}
	$sql_btsls="delete from tbl_srbtslsub where btslsub_barcode='$a'";
	$xcxc=mysqli_query($link,$sql_btsls) or die(mysqli_error($link));
	
		
	$sql_btslm=mysqli_query($link,"select * from tbl_srbtslsub where plantcode='$plantcode' AND btsl_id='$trid' order by btslsub_id asc") or die(mysqli_error($link));
	$ttoott=mysqli_num_rows($sql_btslm);
	if($ttoott==0)
	{
		$sql_btslm="delete from tbl_srbtslmain where btsl_id='$trid'";
		$xcc=mysqli_query($link,$sql_btslm) or die(mysqli_error($link));
		$trid=0;
	}

?>
<?php
$tid=$trid;
$subtid=0;
?>
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">	
<tr class="Light" height="20">
    <td width="50%" align="right" valign="middle" class="tblheading" >Enter Barcode&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading" >&nbsp;<input type="text" name="barcode" id="txtbarcod" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onchange="chkbarcode1(this.value)" /></td>
</tr>
</table><br />
<table align="center" border="1" width="950" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse">	
<tr class="Light" height="20">
    <td width="50%" align="right" valign="middle" class="tblheading" >Delete Barcode&nbsp;</td>
	<td width="50%" align="left" valign="middle" class="tblheading" >&nbsp;<input type="text" name="delbarcode" id="txtbarcoddel" size="11" maxlength="11" class="smalltbltext"  onkeypress="return isNumberKey24(event)" onchange="chkbarcode24(this.value)" /></td>
</tr>
</table><br />


<div id="showcvdet"></div>
<br />
<table align="center" height="25" width="950"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="smalltblheading" colspan="7">SLOC Details - Identified Barcodes</td>
  </tr>	
<tr class="tblsubtitle" height="20">
	<td width="4%" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="11%" align="center" valign="middle" class="smalltblheading">WH</td>
	<td width="11%" align="center" valign="middle" class="smalltblheading">Bin</td>
	<td width="11%" align="center" valign="middle" class="smalltblheading">Sub-Bin</td>
    <td width="23%" align="center" valign="middle" class="smalltblheading">Crop</td>
    <td width="28%" align="center" valign="middle" class="smalltblheading">Variety</td>
    <td width="12%" align="center" valign="middle" class="smalltblheading">No. of Barcode(s)</td>
</tr>
<?php
$sno1=1; $nobrc=0; $nobcd="";
 $sql_identfy1=mysqli_query($link,"select distinct btslss_subbin from tbl_srbtslsub_sub where plantcode='$plantcode' AND btsl_id='$tid'") or die(mysqli_error($link));
 $tot_identfy1=mysqli_num_rows($sql_identfy1);
 if($tot_identfy1 > 0)
 {
 while($row_identfy1=mysqli_fetch_array($sql_identfy1))
 {
 	if($isbn!="")
	$isbn=$isbn.",".$row_identfy1['btslss_subbin'];
	else
	$isbn=$row_identfy1['btslss_subbin'];

 $sql_identfy2=mysqli_query($link,"select max(btslss_id) from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslss_subbin='".$row_identfy1['btslss_subbin']."'") or die(mysqli_error($link));
 $tot_identfy2=mysqli_num_rows($sql_identfy2);
 $row_identfy2=mysqli_fetch_array($sql_identfy2);

	
 $sql_identfy=mysqli_query($link,"select *  from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslss_id='".$row_identfy2[0]."'") or die(mysqli_error($link));
 $tot_identfy=mysqli_num_rows($sql_identfy);
 while($row_identfy=mysqli_fetch_array($sql_identfy))
 {
 $ssid=$row_identfy['btslsub_id'];
 
 $sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_identfy['btslss_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_identfy['btslss_bin']."' and plantcode='$plantcode' AND whid='".$row_identfy['btslss_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_identfy['btslss_subbin']."' and binid='".$row_identfy['btslss_bin']."' and whid='".$row_identfy['btslss_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sql_sub=mysqli_query($link,"Select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_id='".$row_identfy['btslsub_id']."'") or die(mysqli_error($link));
$row_sub=mysqli_fetch_array($sql_sub);

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_sub['btslsub_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
$crp=$noticia['cropname'];

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_sub['btslsub_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
$ver=$noticia_item['popularname'];

$sql_identfy24=mysqli_query($link,"select * from tbl_srbtslsub_sub where plantcode='$plantcode' AND btslss_subbin='".$row_identfy1['btslss_subbin']."' and btsl_id='$tid'") or die(mysqli_error($link));
$nobrc=mysqli_num_rows($sql_identfy24);
while($rowbarcsub=mysqli_fetch_array($sql_identfy24))
{
	$brcod=$rowbarcsub['btslsub_barcode'];
	if($nobcd!="")
	$nobcd=$nobcd.",".$brcod;
	else
	$nobcd=$brcod;
}
?> 	
<tr>
	<td width="4%" align="center"  valign="middle" class="smalltbltext" ><?php echo $sno1?></td>
	<td width="11%" align="center"  valign="middle" class="smalltbltext" ><?php echo $wareh?></td>
	<td width="11%" align="center"  valign="middle" class="smalltbltext" ><?php echo $binn?></td>
	<td width="11%" align="center"  valign="middle" class="smalltbltext" ><?php echo $subbinn?></td>
	<td width="23%" align="center"  valign="middle" class="smalltbltext" ><?php echo $crp?></td>
	<td width="28%" align="center"  valign="middle" class="smalltbltext" ><?php echo $ver?></td>
	<td width="12%" align="center"  valign="middle" class="smalltbltext" title="<?php echo $nobcd;?>" ><?php echo $nobrc?></td>
</tr>
<?php
}
}
}
?>
</table><br />

<table align="center" height="25" width="950"  border="1" cellspacing="0" cellpadding="0" bordercolor="#a8a09e" style="border-collapse:collapse" >	
<tr class="tblsubtitle" height="20">
    <td align="center" valign="middle" class="smalltblheading" colspan="7">SLOC Details - Un-Identified Barcodes</td>
  </tr>	
<tr class="tblsubtitle" height="20">
	<td width="4%" align="center" valign="middle" class="smalltblheading">#</td>
	<td width="11%" align="center" valign="middle" class="smalltblheading">WH</td>
	<td width="11%" align="center" valign="middle" class="smalltblheading">Bin</td>
	<td width="11%" align="center" valign="middle" class="smalltblheading">Sub-Bin</td>
    <td width="23%" align="center" valign="middle" class="smalltblheading">Crop</td>
    <td width="28%" align="center" valign="middle" class="smalltblheading">Variety</td>
    <td width="12%" align="center" valign="middle" class="smalltblheading">No. of Barcode(s)</td>
</tr>	
<?php
$sno2=1; $nobrc=0; $nobcd="";
 $sql_identfy1=mysqli_query($link,"select distinct btslss_subbin from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btsl_id='$tid'") or die(mysqli_error($link));
 $tot_identfy1=mysqli_num_rows($sql_identfy1);
 if($tot_identfy1 > 0)
 {
 while($row_identfy1=mysqli_fetch_array($sql_identfy1))
 {
 	if($isbn!="")
	$isbn=$isbn.",".$row_identfy1['btslss_subbin'];
	else
	$isbn=$row_identfy1['btslss_subbin'];

 $sql_identfy2=mysqli_query($link,"select max(btslss_id) from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslss_subbin='".$row_identfy1['btslss_subbin']."'") or die(mysqli_error($link));
 $tot_identfy2=mysqli_num_rows($sql_identfy2);
 $row_identfy2=mysqli_fetch_array($sql_identfy2);

	
 $sql_identfy=mysqli_query($link,"select *  from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslss_id='".$row_identfy2[0]."'") or die(mysqli_error($link));
 $tot_identfy=mysqli_num_rows($sql_identfy);
 while($row_identfy=mysqli_fetch_array($sql_identfy))
 {
 $ssid=$row_identfy['btslsub_id'];
 
 $sql_whouse=mysqli_query($link,"select perticulars from tbl_warehouse where plantcode='$plantcode' AND whid='".$row_identfy['btslss_wh']."' order by perticulars") or die(mysqli_error($link));
$row_whouse=mysqli_fetch_array($sql_whouse);
$wareh=$row_whouse['perticulars'];

$sql_binn=mysqli_query($link,"select binname from tbl_bin where binid='".$row_identfy['btslss_bin']."' and plantcode='$plantcode' AND whid='".$row_identfy['btslss_wh']."'") or die(mysqli_error($link));
$row_binn=mysqli_fetch_array($sql_binn);
$binn=$row_binn['binname'];

$sql_subbinn=mysqli_query($link,"select sname from tbl_subbin where plantcode='$plantcode' AND sid='".$row_identfy['btslss_subbin']."' and binid='".$row_identfy['btslss_bin']."' and whid='".$row_identfy['btslss_wh']."'") or die(mysqli_error($link));
$row_subbinn=mysqli_fetch_array($sql_subbinn);
$subbinn=$row_subbinn['sname'];

$sql_sub=mysqli_query($link,"Select * from tbl_srbtslsub where plantcode='$plantcode' AND btslsub_id='".$row_identfy['btslsub_id']."'") or die(mysqli_error($link));
$row_sub=mysqli_fetch_array($sql_sub);

$quer3=mysqli_query($link,"SELECT cropid, cropname FROM tblcrop where cropid='".$row_sub['btslsub_crop']."' order by cropname Asc");
$noticia = mysqli_fetch_array($quer3);
$crp=$noticia['cropname'];

$quer4=mysqli_query($link,"SELECT varietyid, popularname FROM tblvariety  where varietyid='".$row_sub['btslsub_variety']."' and actstatus='Active' order by popularname Asc"); 
$noticia_item = mysqli_fetch_array($quer4);
$ver=$noticia_item['popularname'];

$sql_identfy24=mysqli_query($link,"select * from tbl_srbtslsub_sub2 where plantcode='$plantcode' AND btslss_subbin='".$row_identfy1['btslss_subbin']."' and btsl_id='$tid'") or die(mysqli_error($link));
$nobrc=mysqli_num_rows($sql_identfy24);
while($rowbarcsub=mysqli_fetch_array($sql_identfy24))
{
	$brcod=$rowbarcsub['btslsub_barcode'];
	if($nobcd!="")
	$nobcd=$nobcd.",".$brcod;
	else
	$nobcd=$brcod;
}
?> 	
<tr>
	<td width="4%" align="center"  valign="middle" class="smalltbltext" ><?php echo $sno2?></td>
	<td width="11%" align="center"  valign="middle" class="smalltbltext" ><?php echo $wareh?></td>
	<td width="11%" align="center"  valign="middle" class="smalltbltext" ><?php echo $binn?></td>
	<td width="11%" align="center"  valign="middle" class="smalltbltext" ><?php echo $subbinn?></td>
	<td width="23%" align="center"  valign="middle" class="smalltbltext" ><?php echo $crp?></td>
	<td width="28%" align="center"  valign="middle" class="smalltbltext" ><?php echo $ver?></td>
	<td width="12%" align="center"  valign="middle" class="smalltbltext" title="<?php echo $nobcd;?>" ><?php echo $nobrc?></td>
</tr>
<?php
}
}
}
?>
</table>
<input type="hidden" name="maintrid" value="<?php echo $tid;?>" /><input type="hidden" name="subtrid" value="<?php echo $subtid;?>" />
<table align="center" width="950" cellpadding="5" cellspacing="5" border="0" >
<tr >
<td valign="top" align="right"><img src="../images/post.gif" border="0"style="display:inline;cursor:Pointer;" onClick="pform();" />&nbsp;&nbsp;</td>
</tr>
</table>
</div>